/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_strncpy.c                                       :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/11/10 13:17:47 by malallai          #+#    #+#             */
/*   Updated: 2018/11/10 13:52:51 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "libft.h"

char	*ft_strncpy(char *dst, const char *src, size_t n)
{
	unsigned char *t_dst;

	if (!dst || !src)
		return (0);
	t_dst = (unsigned char*)dst;
	while (*src && n-- > 0)
		*t_dst++ = *src++;
	while (n-- > 0)
		*t_dst++ = '\0';
	return (t_dst);
}
