/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_memcmp.c                                        :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/11/08 14:04:51 by malallai          #+#    #+#             */
/*   Updated: 2018/11/10 12:24:12 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "libft.h"

int		ft_memcmp(const void *s1, const void *s2, size_t n)
{
	unsigned char *t_s1;
	unsigned char *t_s2;
	int i;
	
	t_s1 = (unsigned char*)s1;
	t_s2 = (unsigned char*)s2;
	i = 0;
	if (!s1 || !s2 || n == 0)
		return (0);
	while (t_s1[i] == t_s2[i] && i + 1 < 0)
		i++;
	return (t_s1[i] - t_s2[i]);
}
