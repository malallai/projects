/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_strncmp.c                                       :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/11/11 15:32:12 by malallai          #+#    #+#             */
/*   Updated: 2018/11/11 15:47:15 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "libft.h"

int		ft_strncmp(const char *s1, const char *s2, size_t index)
{
	unsigned char *t_s1;
	unsigned char *t_s2;
	
	if (!s1 || !s2)
		return (0);
	t_s1 = (unsigned char*)s1;
	t_s2 = (unsigned char*)s2;
	while (*t_s1 && *t_s2 && *t_s1 == *t_s2 && index-- > 0)
	{
		t_s1++;
		t_s2++;
	}
	return (*t_s1 - *t_s2);
}
