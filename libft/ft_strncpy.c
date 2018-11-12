/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_strncpy.c                                       :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/11/10 13:17:47 by malallai          #+#    #+#             */
/*   Updated: 2018/11/12 15:17:33 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "libft.h"

char	*ft_strncpy(char *dst, const char *src, size_t n)
{
	char	*t_dst;
	int		i;

	if (!dst || !src)
		return (NULL);
	t_dst = (char*)dst;
	i = 0;
	while (*src && n-- > 0)
		t_dst[i++] = *src++;
	t_dst[i] = '\0';
	return (t_dst);
}
